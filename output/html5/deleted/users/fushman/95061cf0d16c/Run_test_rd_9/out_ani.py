# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 6.95, 24.03, -1.68, -6.89, -23.54, 1.81, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -9.37, 1.14, -20.84, 10.14, -1.33, 22.97, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 25.58, -8.37, -11.80, -28.79, 9.30, 13.41, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
