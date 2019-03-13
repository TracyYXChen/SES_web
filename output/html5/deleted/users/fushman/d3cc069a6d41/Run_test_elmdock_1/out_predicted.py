# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 3.84, -1.10, 19.52, 4.45, 0.57, -21.84, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 5.39, -26.31, -0.76, 3.11, 20.55, 1.09, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -33.26, -2.11, -0.35, 32.08, 1.02, 0.73, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_predicted')
