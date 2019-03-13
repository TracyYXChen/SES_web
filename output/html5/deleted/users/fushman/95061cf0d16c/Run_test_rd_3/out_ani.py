# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 104.99, -71.24, -16.64, 38.57, -90.99, 11.68, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 68.78, -95.32, -18.96, 74.71, -65.75, 15.59, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 85.03, -102.90, 13.89, 55.14, -54.45, -22.44, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
