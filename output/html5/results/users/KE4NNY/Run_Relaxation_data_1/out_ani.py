# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 57.72, -99.60, 2.39, 44.51, -59.69, -8.01, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 67.99, -79.91, -18.40, 35.98, -82.36, 12.86, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 38.22, -89.34, -16.77, 65.01, -72.99, 11.94, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
