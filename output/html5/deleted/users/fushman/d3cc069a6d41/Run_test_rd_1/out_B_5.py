# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 15.13, 3.83, 31.16, -9.03, -6.22, -0.96, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 5.31, 18.11, 7.87, 1.29, -19.97, 22.82, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 22.18, -7.84, 3.30, -13.07, 4.74, 25.88, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_5')
