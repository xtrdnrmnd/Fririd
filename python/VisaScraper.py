# importing pandas as pd
import pandas as pd
# For parcing the data
import requests
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
    table = soup.find(
        "table", class_="wikitable sortable jquery-tablesorter")
    print(table)


ScrapTheList("https://en.wikipedia.org/wiki/Lists_of_earthquakes")
