# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 62.07, -94.82, -2.77, 40.51, -66.65, -2.03, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 65.23, -70.28, -19.96, 38.65, -91.52, 14.30, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 39.50, -90.05, -17.32, 63.98, -72.10, 12.80, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
