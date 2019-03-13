# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -15.35, 6.55, 1.63, -39.52, -3.51, -30.47, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -25.18, 20.83, -21.66, -29.19, -17.26, -6.70, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -8.31, -5.13, -26.22, -43.55, 7.45, -3.63, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_4')
