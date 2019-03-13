# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 65.38, -66.19, -14.50, 29.66, -76.71, 0.31, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 44.37, -85.47, -23.20, 49.72, -57.67, 9.46, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 61.32, -95.15, 10.83, 33.15, -48.68, -24.13, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
