# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 15.57, 0.08, 5.95, -14.46, -0.84, -5.62, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 6.15, 5.19, -16.06, -5.31, -5.45, 14.53, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 3.01, -20.37, -5.87, -3.12, 22.24, 6.65, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
