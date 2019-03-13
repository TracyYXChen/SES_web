# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -25.68, 11.20, 21.35, -49.78, 0.90, -10.56, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -35.56, 25.39, -2.00, -39.42, -12.70, 13.21, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -18.61, -0.60, -6.41, -53.86, 11.98, 16.15, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_2')
