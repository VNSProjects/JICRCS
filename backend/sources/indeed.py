from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
import pandas as pd
import xlwt
import pandas as pd


driver = webdriver.Chrome(r"D:\Code\chromedriver_win32\chromedriver.exe")
df = pd.DataFrame(columns=['Job Title','Company Name','Exp','Location','skills','Functional Areas','rating','Vacancy','Employment Type'])

for x in range(0,20,10):
    driver.get('https://in.indeed.com/jobs?q=developer&start='+str(x))
    index = 0
    while True:
        divs = driver.find_elements_by_class_name('slider_container')
        #element = divs.get_attribute('outerHTML')
        #print(element)
        
        try:
            divs[index].click()
        except IndexError:
            break
        except:
            pass
        c=driver.find_element_by_css_selector(".jobsearch-JobInfoHeader-title") #
        d=c.get_attribute('outerHTML')        
        pages = d
        index+=1
        soup = BeautifulSoup(pages,'html.parser')
        #print(soup.prettify())
        print(soup.text)

        #print(soup.findAll("h1", {"class": "jobsearch-JobInfoHeader-title"}))
        print("---------------------------------------------------------------------------\n")
        #print(soup.find("div", {"class": "jobsearch-CompanyInfoContainer"}))

        pages = ''

