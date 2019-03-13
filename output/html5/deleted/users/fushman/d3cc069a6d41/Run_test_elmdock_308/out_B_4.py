# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 25.52, 1.65, 19.94, 1.32, -8.25, -12.32, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 15.74, 15.99, -3.32, 11.61, -22.09, 11.47, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 32.56, -9.95, -7.97, -2.69, 2.64, 14.61, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_4')
