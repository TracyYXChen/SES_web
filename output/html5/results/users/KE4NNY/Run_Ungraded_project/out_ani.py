# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 59.25, -104.20, 3.59, 42.99, -55.08, -9.21, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 71.56, -79.63, -21.89, 32.41, -82.63, 16.35, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 35.07, -91.26, -20.15, 68.15, -71.07, 15.31, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
