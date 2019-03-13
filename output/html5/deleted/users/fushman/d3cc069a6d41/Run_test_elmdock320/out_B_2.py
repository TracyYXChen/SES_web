# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 39.24, -13.47, 12.37, 15.10, -23.59, -19.70, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 29.41, 0.78, -10.94, 25.43, -37.30, 4.08, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 46.30, -25.18, -15.46, 11.05, -12.60, 7.11, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_2')
