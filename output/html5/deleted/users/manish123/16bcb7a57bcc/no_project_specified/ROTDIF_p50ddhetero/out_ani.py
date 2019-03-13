# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -4.64, -38.32, 10.90, 0.03, 69.18, 29.11, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -51.36, 16.56, 13.75, 46.23, 10.31, 25.54, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -8.90, 5.31, 69.22, 4.21, 21.65, -30.62, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
