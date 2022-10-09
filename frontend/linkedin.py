import requests
from bs4 import BeautifulSoup
import mysql.connector
import sys
ourdb = mysql.connector.connect(host="localhost", user="root", password="", database="JICRCS")

ourcursor = ourdb.cursor()
k = sys.argv[1]
keywords = k.replace(' ', '-')
# keywords = sys.argv[1] #'web-development' #input()
location = '' #'Pune Maharashtra' #input()

def LN():
    URL = 'https://www.linkedin.com/learning/search?keywords='+ keywords
    page = requests.get(URL)
    soup = BeautifulSoup(page.content, "html.parser")

    # print(URL)   

    # print(soup.text.strip())

    name = []
    host = []
    ty = []
    level = []
    link = []

    
    for n in soup.findAll('h3', attrs = {'class':'base-search-card__title'}):
        name.append(n.get_text().strip().replace("'", "").replace("…", ""))
    
    
        
    # print(name)
    # print(len(name))

 
    for h in soup.findAll('h4', attrs = {'class':'base-search-card__subtitle'}):
        host.append(h.get_text().strip().replace("By: ", ""))
   
    
        
    # print(host)
    # print(len(host))

 
    for t in soup.findAll('p', attrs = {'class':'base-search-card__identifier'}):
        ty.append(t.get_text().strip().replace("…", ""))
  

    # print(ty)
    # print(len(ty))


    for a in soup.findAll('a', attrs = {'class':'base-search-card--link'}):        
        link.append(a.get('href'))
   
    

    # print(link)
    # print(len(link))
   
    
    ran = len(name)
    
    for x in range(ran):
        sql = "INSERT INTO courses (name, host, type, link) VALUES ('" + name[x] + "', '" + host[x] + "', '" + ty[x] + "', '" + link[x] + "');"
        ourcursor.execute(sql)
        ourdb.commit()

    ran = len(name)
    
    # for x in range(ran):

    #     print("\n--------------------- ", x ," -----------------------\n")
    #     print(name[x])
    #     print(host[x])
    #     print(ty[x])
    #     print(link[x])

        
            
def main():
    LN()

if __name__ == "__main__":
    main()
    
ourdb.close()