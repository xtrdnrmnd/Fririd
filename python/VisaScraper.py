# importing pandas as pd
import pandas as pd
# For parcing the data
import requests
import re
from urllib.request import urlopen
from bs4 import BeautifulSoup


def ScrapTheList(url):
    request_headers = {
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_5) AppleWebKit/537.36 \
                (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36"
    }

    response = requests.get(
        url=url,
    )
    soup = BeautifulSoup(response.content, 'html.parser')

    firstH3 = soup.findAll('h3')  # Start here
    listOfLists = []
    for i in firstH3:
        for nextSibling in i.findNextSiblings():
            if nextSibling.name == 'h2':
                break
            if nextSibling.name == 'ul':
                listOfLists.append(nextSibling)
            listOfA = []
            for ul in listOfLists:
                for a in ul.findAll('a', href=True):
                    if a.find('ul'):
                        break
                    listOfA.append("https://en.wikipedia.org" + a['href'])

            for a in listOfA:
                response = requests.get(
                    url=a,
                )

                soup = BeautifulSoup(response.content, 'html.parser')

                if (soup.find('table', {'class': 'sortable wikitable'}) is not None):
                    table = soup.select_one(
                        "table:nth-of-type(1)", {'class': 'sortable wikitable'}).tbody
                    rows = table.find_all('tr')
                    columns = ["Origin"]
                    for v in rows[0].find_all('th'):
                        while (len(columns) < 5):
                            columns.append(v.text.replace('\n', ''))
                    origin = soup.find('h1', id='firstHeading').text.replace(
                        "Visa requirements for ", "").replace(" citizens", "")
                    df2 = pd.DataFrame(columns=columns)
                    for i in range(1, len(rows)):
                        tds = rows[i].find_all('td')
                        if len(tds) >= 4:
                            values = [origin, tds[0].text.replace('\n', ''), re.sub('[[0-9]*]', '', tds[1].text).replace('\n', '').replace('\xa0', ''), re.sub('[[0-9][A-Z][a-z]*]', '', tds[2].text.replace('\n', '')),
                                      tds[3].text.replace('\n', '')]
                        df2 = df2.append(pd.Series(values, index=columns),
                                         ignore_index=True)

                    df2.to_csv(r'data/visa.csv', mode='a', index=False)
                print("done with " + a)
        listOfLists.clear()


ScrapTheList(
    "https://en.wikipedia.org/wiki/Category:Visa_requirements_by_nationality")
