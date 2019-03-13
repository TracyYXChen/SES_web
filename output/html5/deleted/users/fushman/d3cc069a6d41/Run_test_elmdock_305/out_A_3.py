# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -8.95, 18.67, -5.28, -16.67, -19.31, 4.98, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -21.35, -1.48, -15.51, -3.03, 3.29, 15.96, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 11.44, -7.52, -13.17, -31.32, 7.29, 9.47, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_A_3')
