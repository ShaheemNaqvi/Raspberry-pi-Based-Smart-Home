#Check mpack & stmp config file to use this code

import RPi.GPIO as GPIO
import os
import time

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(11, GPIO.IN)         #Read output from PIR motion sensor
GPIO.setup(3, GPIO.OUT)         #LED output pin
while True:
       i=GPIO.input(11)
       if i==0:                 #When output from motion sensor is LOW
             print ("No intruders"),i
             GPIO.output(3, 0)  #Turn OFF buzzer
             time.sleep(0.1)
       elif i==1:               #When output from motion sensor is HIGH
             print ("Intruder detected",i)
             os.system("fswebcam -r 680x420 image2.jpg")
             os.system("mpack -s \"test\" /home/pi/image2.jpg shaheem@gmail.com")
             GPIO.output(3, 1)  #Turn ON buzzer
             time.sleep(10)
 
