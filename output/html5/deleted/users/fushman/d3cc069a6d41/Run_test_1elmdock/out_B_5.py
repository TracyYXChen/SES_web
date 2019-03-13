# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -11.98, 7.91, 21.50, -36.13, -2.18, -10.60, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -21.81, 22.17, -1.80, -25.80, -15.91, 13.18, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -4.92, -3.78, -6.34, -40.17, 8.79, 16.23, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_5')
