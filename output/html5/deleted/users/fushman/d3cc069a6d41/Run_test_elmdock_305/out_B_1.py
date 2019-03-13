# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -22.47, 8.66, 20.41, -46.54, -1.73, -11.40, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -32.38, 22.81, -2.95, -36.16, -15.28, 12.36, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -15.39, -3.19, -7.31, -50.64, 9.39, 15.26, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_1')
