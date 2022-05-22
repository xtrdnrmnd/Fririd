# importing pandas as pd
import pandas as pd
# For parcing the data
import requests
from bs4 import BeautifulSoup


def ScrapTheList(url):
    request_headers = {
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_5) AppleWebKit/537.36 \
                (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36"
    }
    table_class = "wikitable sortable jquery-tablesorter"

    response = requests.get(
        url=url,
    )
    soup = BeautifulSoup(response.text, 'html.parser')

    table = soup.find('table', {'class': 'wikitable sortable'}).tbody
    rows = table.find_all('tr')
    columns = [v.text.replace('\n', '') for v in rows[0].find_all('th')]

    df = pd.DataFrame(columns=columns)
    for i in range(1, len(rows)):
        tds = rows[i].find_all('td')
        id = 0
        if len(tds) == 4:
            values = [id, tds[0].text, tds[1].text, tds[2].text,
                      tds[3].text]
        else:
            values = [td.text.replace('\n', ''.replace('\xa0', ''))
                      for td in tds]
        id += 1
        df = df.append(pd.Series(values, index=columns), ignore_index=True)
    # print(df)

    df.to_csv(r'report.csv', index=False)


ScrapTheList("https://en.wikipedia.org/wiki/Lists_of_earthquakes")

# list of name, degree, score
nme = ["aparna", "pankaj", "sudhir", "Geeku"]
deg = ["MBA", "BCA", "M.Tech", "MBA"]
scr = [90, 40, 80, 98]

# dictionary of lists
dict = {'name': nme, 'degree': deg, 'score': scr}

df = pd.DataFrame(dict)

# saving the dataframe
df.to_csv('data/earthquakes.csv')
