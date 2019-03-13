# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 21.31, -1.48, 8.89, -2.84, -11.58, -23.19, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 11.47, 12.78, -14.41, 7.49, -25.30, 0.58, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 28.36, -13.17, -18.95, -6.89, -0.60, 3.62, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_2')
