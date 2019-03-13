# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -37.55, 8.77, 0.43, -61.70, -1.30, -31.69, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -47.37, 23.04, -22.87, -51.38, -15.04, -7.91, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -30.49, -2.91, -27.43, -65.74, 9.66, -4.85, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_4')
