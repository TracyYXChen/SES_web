# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 11.47, 22.33, -3.81, -3.46, -23.71, 4.47, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
