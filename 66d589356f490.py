file = "/sdcard/Download/auth.txt"

file_send = "/sdcard/Download/nja5.txt"

file_text = "text.txt"
  
caption = "caption"

id_create = 3

text_q = ["test1","test2"]
question = "ایا حق با من است؟"

channel_text = "توی گروه جوین شو"

Dast = ["Group"]
time = 0 
picture_c = "image.png"
picture_g = "image.png"


from pyrubi import Client
from ast import literal_eval
from random import randint,choice
from string import ascii_lowercase,ascii_letters,ascii_uppercase
from re import findall
from threading import Thread
from colorama import Fore
import ast
import pyrubi
import time as t
import os

a = 0
b = 0

magenta = "\033[95m"
cyan = "\033[95m"
bold = "\033[97m"
underline = "\033[4m"
red = "\033[31m" 
blue = "\033[36m" 
pink = "\033[35m" 
yellow = "\033[93m" 
darkblue = "\033[34m" 
white = "\033[00m"
green = "\033[32m" 
red = '\033[91m'
green = '\033[92m'
blue = '\033[94m'
yellow = '\033[93m'
magenta = '\033[95m'
cyan = '\033[96m'
white = '\033[97m'
underline = '\033[4m'
black='\033[30m'
Backsilver='\033[100m'
silver='\033[90m'
Backwhite='\033[3m'
Backgreen='\033[42m'
Backyellow='\033[43m'
BackBlue='\033[44m'
Backpink='\033[45m'
Backcyan='\033[46m'
auth = literal_eval(open(file,"r").read())
private = ""
for m in auth[0]:
	if m.startswith("malek"):
		private = m
	elif m.startswith("key"):
		private = m
text = open(file_text,"r").read()
def user():
	data = ""
	for i in range(10):
		data += choice(ascii_lowercase+ascii_uppercase+"1234567890")
	return data
try:
	open("link.txt","r").read()
	
except:
	open("link.txt","w").write("")
	
def updateChannelUsername(bot,username=None):
	data = {"channel_guid":bot.add_channel("god")["channel"]["channel_guid"],"username":username if username=="None" else user()}
	guid = bot.add_channel("god",private=False)
	print(guid)

	data = bot.edit_channel_info( object_guid=guid["channel"]["channel_guid"],username=user(),private=False)["channel"]
	
	print(data)
	
	return (data["share_url"],data["channel_guid"])
def checkCreate(id):
	x = choice(auth)
	bot = Client(auth=x["auth"],private=x[private],platform="android")
	link_priv = open("link.txt","r").read()
	link_channel = link_priv.replace("https://rubika.ir/","") if link_priv.startswith("https://rubika.ir/") else link_priv
	
	cheack = bot.get_chat_info_by_username(id)["exist"]
	print(cheack)
	if cheack == False:
		
		if link_channel == "":
			pass
		else:
			open("link.txt","w").write("")
		data = updateChannelUsername(bot)
		print(data)
		url = data[0]
		guid = data[1]
		open("link.txt", "w").write(f"{data[0]}")
		print(guid)
		data_up = bot.send_file(guid,file=file_send,text=caption)
		
		if (data_up):
			
			link = bot.get_message_share_url(object_guid=data_up["message_update"]["object_guid"],message_id=data_up["message_update"]["message_id"])["share_url"]
			print(link)
			data = findall(r"https://rubika\.ir/(.*)",text)
			link = findall(r"https://rubika\.ir/(.*)",link)[0]
			for m in data:
				print(m)
				mew_text = text.replace(m,link)
				print(mew_text)
				open(file_text,"w").write(mew_text)
			
			print(bot.leave_chat(guid))
			
			print(bot.get_chat_info_by_username(id)["exist"])
			return True
			
	else:
		return False
def Send(guid):
	try:
		data = bot.send_text(guid,text)
		
		bot.methods.network.request("deleteMessages",{"object_guid":guid,"message_ids":[data["message_update"]["message_id"]],"type":"Local"})
		global a
		a+=1
	except:
		global b
		b+=1

while True:
	for i in auth:
			try:
				try:
					for m in i.items():
						if len(m[1]) == 32:
							aut = m[1]
						else:
							p = m[1]
					bot = pyrubi.Client(auth=aut,private=p,platform="android",api_version=6)
					
				except:
					auth.remove(i)
				
				
				link_priv = open("link.txt","r").read()
				link_channel = link_priv.replace("https://rubika.ir/","") if link_priv.startswith("https://rubika.ir/") else link_priv
				
				test = checkCreate(link_channel)
				if test == False:
						pass
						
				elif test == True:
						print("channel New Create")
				text = open(file_text,"r").read()
				for chat in bot.get_chats()['chats']:
					
					if 'SendMessages' in chat['access']:
						if chat['abs_object']['type'] in Dast:
							Thread(target=Send, args=[chat['object_guid']]).start()
							t.sleep(time)
							os.system("clear")
							if chat['abs_object']['type'] == "User":
								print(f"""
 {green} Mofagh {yellow}=> {silver}{a}
 
 {red} Na Mofagh {yellow}=> {silver}{b}
 
 {blue} Name {yellow}=> {silver}{chat['abs_object']['first_name']}
 
 {pink} Type {yellow}=> {silver}{chat['abs_object']['type']}""")
							else:
								print(f"""
 {green} Mofagh {yellow}=> {silver}{a}
 
 {red} Na Mofagh {yellow}=> {silver}{b}
 
 {blue} Name {yellow}=> {silver}{chat['abs_object']['title']}
 
 {pink} Type {yellow}=> {silver}{chat['abs_object']['type']}""")
						
			except:
				pass