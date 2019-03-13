# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 16.06, -0.05, 4.35, -14.65, -0.71, -4.03, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 4.22, 6.61, -15.55, -3.74, -7.03, 14.73, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 2.79, -20.09, -8.18, -2.79, 21.29, 8.99, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
