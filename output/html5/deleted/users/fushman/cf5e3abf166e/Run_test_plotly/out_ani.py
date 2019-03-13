# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 13.60, 1.84, 8.39, -12.74, -2.52, -8.02, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 9.51, 1.90, -15.66, -8.41, -2.48, 14.27, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 4.08, -21.50, -0.73, -4.14, 22.47, 0.79, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
