# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 14.30, 4.45, 30.54, -9.83, -5.76, -1.44, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 4.44, 18.67, 7.21, 0.52, -19.41, 22.33, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 21.35, -7.31, 2.74, -13.89, 5.28, 25.32, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_4')
