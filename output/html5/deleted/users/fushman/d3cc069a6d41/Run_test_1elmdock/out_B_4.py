# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 6.73, 4.04, 26.56, -17.39, -6.16, -5.44, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -3.12, 18.26, 3.23, -7.05, -19.82, 18.34, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 13.79, -7.71, -1.24, -21.45, 4.87, 21.32, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_4')
