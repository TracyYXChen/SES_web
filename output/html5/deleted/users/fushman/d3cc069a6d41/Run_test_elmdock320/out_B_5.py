# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 37.11, 5.96, 33.46, 12.99, -4.26, 1.50, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 27.24, 20.18, 10.14, 23.34, -17.91, 25.27, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 44.17, -5.80, 5.67, 8.92, 6.78, 28.25, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_5')
