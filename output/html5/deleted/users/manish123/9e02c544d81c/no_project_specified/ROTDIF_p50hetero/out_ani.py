# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 5.32, -32.59, 10.21, -11.33, 66.76, 30.62, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -48.38, 6.62, 15.24, 47.30, 20.77, 24.45, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -5.55, 2.80, 68.81, 0.68, 23.76, -28.15, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
