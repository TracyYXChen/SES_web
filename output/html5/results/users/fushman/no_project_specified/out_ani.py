# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 16.00, 1.36, 0.34, -15.23, -2.09, -0.33, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -0.33, 6.84, -15.84, 0.58, -7.35, 15.22, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 2.50, -20.03, -9.04, -2.42, 20.89, 9.79, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
