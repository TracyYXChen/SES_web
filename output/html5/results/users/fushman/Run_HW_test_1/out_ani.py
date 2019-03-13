# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 104.01, -68.96, -16.40, 39.43, -93.18, 11.36, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 70.70, -95.06, -16.67, 72.55, -65.75, 13.21, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 86.46, -100.30, 15.43, 52.43, -56.45, -25.48, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
