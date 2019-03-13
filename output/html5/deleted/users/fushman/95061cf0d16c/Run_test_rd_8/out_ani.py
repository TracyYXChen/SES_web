# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 75.84, -62.54, 13.04, 67.70, -98.06, -16.59, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 107.58, -88.65, -3.34, 32.32, -72.92, -1.51, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 68.65, -97.51, 17.98, 74.76, -63.31, -24.70, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
