# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 103.00, -67.44, -17.50, 40.67, -94.58, 12.33, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 71.65, -95.64, -15.52, 71.51, -65.77, 11.36, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 88.59, -98.68, 17.13, 49.88, -58.74, -27.45, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
