# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 40.97, 2.43, 30.62, -48.04, 24.99, 8.13, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -9.57, -32.66, 1.85, 5.37, 63.25, 38.92, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -19.81, -3.81, 71.28, 14.12, 29.77, -29.27, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
