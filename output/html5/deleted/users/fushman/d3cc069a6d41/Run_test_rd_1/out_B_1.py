# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -23.79, 9.11, 20.50, -47.94, -0.97, -11.60, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -33.61, 23.38, -2.80, -37.62, -14.71, 12.18, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -16.74, -2.58, -7.35, -51.98, 10.00, 15.23, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_1')
