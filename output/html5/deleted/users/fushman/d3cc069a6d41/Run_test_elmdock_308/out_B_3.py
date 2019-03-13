# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -23.30, 7.16, 14.73, -46.37, 3.21, -19.43, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -30.22, 24.56, -8.18, -39.79, -13.92, 2.73, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -18.89, -1.74, -12.79, -53.73, 13.11, 9.02, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_3')
