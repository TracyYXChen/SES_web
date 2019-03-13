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
from subprocess import Popen, PIPE, STDOUT

#import our functions
from run_ses import ses
from StringIO import StringIO

if __name__ == "__main__":
    color_list=[ '#1f77b4','#ff7f0e','#2ca02c','#d62728', '#9467bd',\
'#8c564b', '#e377c2', '#7f7f7f', '#bcbd22','#17becf']
    json_variables = " " 
    InitialDirectoryStr = os.path.abspath(os.path.dirname(sys.argv[0]))
    argv_io_string = StringIO(sys.argv[1])
    json_variables = json.load(argv_io_string)
    mat_location = json_variables['mat_location']
    old_mat = os.path.basename(mat_location[0])
    #with open('locations.txt','w') as in_f:
    #    in_f.write(str(json_variables))
    exp_location = json_variables['exp_location']
    old_exp = os.path.basename(exp_location[0])
    run_name = json_variables['run_name']
    sub_dir = "SES_" + str(run_name)
    if os.path.isdir(sub_dir):
        pass
    else:
        os.mkdir(sub_dir)

    new_mat = join(sub_dir,old_mat)
    new_exp = join(sub_dir,old_exp)
    shutil.move(old_mat,new_mat)
    shutil.move(old_exp, new_exp)
    os.chdir(sub_dir)
    output_res = ses(old_mat,old_exp,sub_dir)
    #log_out = ['general_solutions.dat']
    #output_res[ 'output_ses' ] = log_out
    print (json.dumps(output_res))
