import requests
from bs4 import BeautifulSoup
import mysql.connector
import sys

keyword = 'python'
URL = 'https://www.edx.org/search?q=python&tab=course'

page = requests.get(URL)
print(URL)
soup = BeautifulSoup(page.content,"html.parser")
print(soup.text)