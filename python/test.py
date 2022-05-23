# importing pandas as pd
import pandas as pd
# For parcing the data
import requests
import re
from urllib.request import urlopen
from bs4 import BeautifulSoup

response = requests.get(
    url="https://en.m.wikipedia.org/wiki/Visa_requirements_for_Antigua_and_Barbuda_citizens")

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
    print(df2)
