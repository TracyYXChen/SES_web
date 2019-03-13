# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 16.07, 1.11, 0.89, -15.07, -1.83, -0.85, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 0.34, 6.87, -15.90, -0.06, -7.25, 15.02, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 2.49, -20.05, -8.94, -2.42, 20.95, 9.71, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
