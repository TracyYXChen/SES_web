# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 24.70, -2.30, 9.27, 0.59, -12.54, -22.69, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 14.83, 11.90, -14.06, 10.94, -26.18, 1.08, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 31.77, -14.07, -18.51, -3.49, -1.49, 4.06, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_1')
