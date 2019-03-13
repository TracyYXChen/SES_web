# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -19.97, 4.96, 10.38, -42.79, 1.47, -23.72, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -26.59, 22.72, -12.31, -36.45, -15.91, -1.76, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -15.41, -3.71, -17.08, -50.26, 11.15, 4.72, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_3')
