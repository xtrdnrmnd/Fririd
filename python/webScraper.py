# importing pandas as pd
import pandas as pd
# For parcing the data
import requests
from bs4 import BeautifulSoup
import re


def ScrapTheList(url):
    request_headers = {
        "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_5) AppleWebKit/537.36 \
                (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36"
    }

    response = requests.get(
        url=url,
    )
    soup = BeautifulSoup(response.text, 'html.parser')

    table = soup.find('table', {'class': table_class}).tbody
    rows = table.find_all('tr')
    columns = [v.text.replace('\n', '') for v in rows[0].find_all('th')]

    df = pd.DataFrame(columns=columns)
    for i in range(1, len(rows)):
        tds = rows[i].find_all('td')
        id = 0
        if len(tds) == 4:
            values = [id, tds[0].text.replace('\n', ''), re.sub(r'^.*,', ',', tds[1].text), tds[2].text,
                      tds[3].text]
            id += 1
        else:
            values = [td.text.replace('\n', ''.replace('\xa0', ''))
                      for td in tds]
        df = df.append(pd.Series(values, index=columns), ignore_index=True)
    # print(df)

    df.to_csv(r'data/earthquakes.csv', index=False)


ScrapTheList("https://en.wikipedia.org/wiki/Lists_of_earthquakes")
