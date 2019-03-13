# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 27.19, -3.36, 8.98, 3.05, -13.47, -23.11, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 17.36, 10.90, -14.33, 13.38, -27.18, 0.67, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 34.25, -15.06, -18.86, -1.00, -2.48, 3.71, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_1')
