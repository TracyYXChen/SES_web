# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 3.99, 68.24, 30.28, -8.43, -38.49, 9.61, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_axial')
