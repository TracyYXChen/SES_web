# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -39.12, 22.29, 19.38, -63.27, 12.20, -12.71, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -48.95, 36.55, -3.92, -52.94, -1.53, 11.06, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -32.06, 10.60, -8.46, -67.31, 23.17, 14.11, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_1')
