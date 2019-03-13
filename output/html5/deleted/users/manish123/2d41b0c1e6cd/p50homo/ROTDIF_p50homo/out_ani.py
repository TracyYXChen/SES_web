# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -8.61, 10.27, 14.84, -13.31, 66.25, 31.26, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -44.67, 37.83, 9.58, 17.53, 36.01, 33.58, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -21.37, 28.14, 49.26, 1.30, 46.86, -8.07, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
