from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
import pandas as pd
import xlwt
import pandas as pd

temp=[]

df = pd.DataFrame(columns=['title', 'company', 'location', 'startdate', 'duration', 'stipend', 'apply', 'tags', 'link'])

pages=''

driver = webdriver.Chrome(r"..\\chromedriver\\chromedriver.exe")

for x in range(1,2):

    driver.get("https://internshala.com/internships/engineering-internship/page-"+str(x))
    divs = driver.find_elements_by_class_name('individual_internship')

    for index in range(1, len(divs)):

        element = divs[index].get_attribute('outerHTML')
        soup = BeautifulSoup(element,'html.parser')

        #print(soup.text)

        title=''

        try:
            title=((soup.find('div', attrs={'class': 'heading_4_5 profile'})).getText()).strip()
        except:
            pass

        company=''

        try:
            company=((soup.find('div', attrs={'class': 'heading_6 company_name'})).getText()).strip()
        except:
            pass

        location=''

        try:
            location=((soup.find('div', attrs={'id': 'location_names'})).getText()).strip()
        except:
            pass        

        startdate=''

        try:
            startdate=(((soup.findAll('div', attrs={'class': 'item_body'}))[0]).getText()).strip()
        except:
            pass

        duration=''

        try:
            duration=(((soup.findAll('div', attrs={'class': 'item_body'}))[1]).getText()).strip()
        except:
            pass

        stipend=''

        try:
            stipend=(((soup.findAll('div', attrs={'class': 'item_body'}))[2]).getText()).strip()
        except:
            pass

        apply=''

        try:
            apply=(((soup.findAll('div', attrs={'class': 'item_body'}))[3]).getText()).strip()
        except:
            pass

        tags=''

        try:
            tags=(((soup.find('div', attrs={'class': 'tags_container'}))).getText()).strip()
        except:
            pass

        link = ''
        url = 'https://internshala.com/'
        a = soup.find('a')

        try:
            path = (a.get('href'))
            link = url + path
        except:
            pass

        temp.append([title, company, location, startdate, duration, stipend, apply, tags, link])

        #print(temp[index-1])        

    title = ''
    company = ''
    location = ''
    startdate = ''
    duration = ''
    stipend = ''
    apply = ''
    tags = ''
    link = ''

    df = pd.DataFrame(temp, columns = ['title', 'company', 'location', 'startdate', 'duration', 'stipend', 'apply', 'tags', 'link'])
    df.to_csv('..\\data\\internshala.csv')