# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 16.05, 0.98, 2.58, -14.84, -1.69, -2.43, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 2.27, 6.07, -16.58, -1.81, -6.29, 15.11, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 3.03, -20.12, -7.32, -3.09, 21.63, 8.17, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
