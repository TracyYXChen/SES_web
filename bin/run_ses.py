#!/usr/bin/python
from os.path import join
import os
import glob
import re
import shutil
import sys
import subprocess
import json
import cStringIO
import shlex 
import socket
import time
import pty
import select
import atexit
import signal
import functools
import itertools
import math
import pandas as pd
import numpy as np
from itertools import groupby
from matplotlib import cm, colors
from StringIO import StringIO
from math import exp, expm1, log10, log, log1p
from subprocess import Popen, PIPE, STDOUT

def message_box(text,icon):
    
    _message = {}
    _message['icon'] = icon
    _message['text'] = text
    
    UDP_IP = json_variables['_udphost']
    UDP_PORT = json_variables['_udpport']
    sock = socket.socket(socket.AF_INET, # Internet
                         socket.SOCK_DGRAM) # UDP
    
    socket_dict={}
    socket_dict['_uuid'] = json_variables['_uuid']
    socket_dict['_message'] = _message

    doc_string = json.dumps(socket_dict)
    sock.sendto(doc_string,(UDP_IP,UDP_PORT))
    
    return

def ses(mat_file,exp_file,sub_dir):
    output_res = {}
    json_variables = " "
    InitialDirectoryStr = os.path.abspath(os.path.dirname(sys.argv[0]))
    argv_io_string = StringIO(sys.argv[1])
    json_variables = json.load(argv_io_string)
    #relax_location = json_variables['relax_location']
    #RelaxStr = relax_location[0]
    #Relaxfilename = os.path.basename(RelaxStr)
    #pdb_location   = json_variables['pdb_location']
    #PdbStr = pdb_location[0]
    #Pdbfilename = os.path.basename(PdbStr)
## UDP messaging ##################################################
    UDP_IP = json_variables['_udphost']
    UDP_PORT = json_variables['_udpport']
    sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    socket_dict={}
    socket_dict['_uuid'] = json_variables['_uuid']
    #json_variables['_base_directory'] = sub_dir
    java_src = '/opt/genapp/ses/bin/sesgeneral-1.1.jar'
    ses_args = []
    ses_args.append('/usr/bin/java')
    ses_args.append('-jar')
    ses_args.append(java_src)
    #ses_args.append('-nogui')
    #ses_args.append('-temp')
    #ses_args.append(json_variables['temperature'])
    ses_args.append('-matrix')
    ses_args.append(mat_file)
    ses_args.append('-data')
    ses_args.append(exp_file)
    ses_args.append('-out')
    ses_args.append('./')
## RUN SES MD  ##########################################################
    socket_dict["_textarea"] = 'Starting SES...\n\n'
    if socket_dict:
        doc_string = json.dumps(socket_dict)
        sock.sendto(doc_string,(UDP_IP,UDP_PORT))
    master_rotdif, slave_rotdif = pty.openpty()
    ProcessRotdif = subprocess.Popen( ses_args,stdout=slave_rotdif,stdin=PIPE,bufsize=0,close_fds=True)    
    stdout_rotdif = os.fdopen(master_rotdif, 'r', 0)
    rotdif_log = open('ses_log.out','w')
    #path_to_live_log = join(str(base_dir),join(sub_dir,'ses_log.out'))
    error_string_md = ''
    timeout = 4 # seconds

    while True:
        ready, _, _ = select.select([master_rotdif], [], [], timeout)
        if ready:
            output = stdout_rotdif.readline()
        #output = stdout_rotdif.read(10)
            if not output:
                break
            if output:
                socket_dict["_textarea"] = output#.strip()
                print >> rotdif_log, output.rstrip()
                rotdif_log.flush()
                if "Percent" in output:
                    output_strip = output.strip()
                    OutArr = re.split(r'[\s]*', output_strip)
                    percent = OutArr[1][:-1]
                    socket_dict['progress_output'] = float(percent)/float(100)
                    socket_dict['progress_text'] = 'SES calculation progress: ' + str(int (float( percent ))) + '%'
                if socket_dict:
                    doc_string = json.dumps(socket_dict)
                    sock.sendto(doc_string,(UDP_IP,UDP_PORT))
        elif ProcessRotdif.poll() is not None:  
            break
              
    ProcessRotdif.wait()
    os.close(slave_rotdif)
    os.close(master_rotdif)
    output_res[ 'progress_output' ] = str(1.0)
    output_res[ 'progress_text' ] =  'SES calculation progress: ' + '100%'                         
    socket_dict["_textarea"] = '\nSES Calculations Completed...\n\n'

    if socket_dict:
        doc_string = json.dumps(socket_dict)
        sock.sendto(doc_string,(UDP_IP,UDP_PORT))
    log_out = join(json_variables['_base_directory'], join(sub_dir,'general_solutions.dat'))
    #with open('outpath.txt','w') as out_f:
    #    out_f.write(str(log_out))
    output_res[ 'output_ses' ] = [log_out] 
    #log_out = [join(str(base_dir),join(sub_dir,'general_solutions.dat'))]
    #output_res[ 'output_ses' ] = log_out
    return output_res

def clean_up():
    for CleanUp in glob.glob('./*.txt'): 
        if not CleanUp.endswith(Relaxfilename):
            os.remove(CleanUp)
    for CleanUp in glob.glob('./*.out'): 
        os.remove(CleanUp)

    for CleanUp in glob.glob('./*.pdb'):
        if not CleanUp.endswith(Pdbfilename):
            os.remove(CleanUp)

