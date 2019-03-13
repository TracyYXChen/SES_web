# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 6.67, -4.68, 10.80, -17.44, -14.96, -21.12, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -3.21, 9.51, -12.55, -7.08, -28.58, 2.65, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 13.73, -16.48, -16.97, -21.52, -3.89, 5.60, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_2')
