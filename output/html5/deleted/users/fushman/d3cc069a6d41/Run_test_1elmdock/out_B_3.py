# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -7.00, -0.84, 6.51, -30.16, -4.97, -27.67, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -14.04, 16.41, -16.49, -23.50, -22.00, -5.44, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -2.65, -9.84, -21.04, -37.49, 5.02, 0.78, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_3')
