# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 19.94, -0.56, 9.39, -4.24, -10.52, -22.82, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 10.15, 13.76, -13.89, 6.07, -24.33, 0.97, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 26.99, -12.19, -18.50, -8.26, 0.39, 4.07, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_2')
