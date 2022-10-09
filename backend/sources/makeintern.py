from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
import pandas as pd
import xlwt
import pandas as pd


driver = webdriver.Chrome(r"E:\Users\nishu\Downloads\chromedriver_win32\chromedriver.exe")
driver.get("https://www.makeintern.com/internships/web-design-and-development-internship")

divs = driver.find_elements_by_class_name('details_outer')
element = divs[0].get_attribute('outerHTML')
soup = BeautifulSoup(element,'html.parser')
print(soup)